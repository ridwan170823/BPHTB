<?php

namespace App\Http\Controllers\Concerns;

use App\Models\Pelayanan;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

trait HandlesPelayananDashboard
{
    /**
     * Build a base query for pelayanan records filtered by the incoming request.
     */
    protected function filteredPelayananQuery(Request $request, array $statuses): Builder
    {
        $query = Pelayanan::query()->whereIn('status', $statuses);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $query->where('no_urut_p', 'like', "%{$request->search}%");
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        return $query;
    }

    /**
     * Paginate pelayanan records for verification tables.
     */
    protected function paginatePelayanan(Request $request, array $statuses, int $perPage = 15): LengthAwarePaginator
    {
        return $this->filteredPelayananQuery($request, $statuses)->paginate($perPage);
    }

    /**
     * Summarize pelayanan counts for dashboard cards.
     */
    protected function getPelayananSummary(array $statusBuckets): array
    {
        $bucketKeys = array_keys($statusBuckets);
        $allStatuses = collect($statusBuckets)
            ->flatten()
            ->filter()
            ->unique()
            ->values();

        if ($allStatuses->isEmpty()) {
            return array_fill_keys($bucketKeys, 0);
        }

        $counts = Pelayanan::query()
            ->selectRaw('status, COUNT(*) as aggregate')
            ->whereIn('status', $allStatuses)
            ->groupBy('status')
            ->pluck('aggregate', 'status');

        return collect($statusBuckets)
            ->map(function ($statuses) use ($counts) {
                return collect($statuses)
                    ->sum(fn ($status) => (int) ($counts[$status] ?? 0));
            })
            ->toArray();
    }

    /**
     * Fetch a limited preview of pelayanan records for dashboard context.
     */
    protected function getPelayananPreview(array $statuses, int $limit = 5): Collection
    {
        return Pelayanan::query()
            ->whereIn('status', $statuses)
            ->orderByDesc('no_urut_p')
            ->limit($limit)
            ->get();
    }

    /**
     * Provide a reusable mapping of pelayanan status labels.
     */
    protected function statusLabels(): array
    {
        return [
            Pelayanan::STATUS_DIAJUKAN => 'Diajukan',
            Pelayanan::STATUS_VERIFIKASI_PELAYANAN => 'Verifikasi Pelayanan',
            Pelayanan::STATUS_DITOLAK_PELAYANAN => 'Ditolak Pelayanan',
            Pelayanan::STATUS_SETUJU_PELAYANAN => 'Disetujui Pelayanan',
            Pelayanan::STATUS_VERIFIKASI_KEPALA_UPT => 'Verifikasi Kepala UPT',
            Pelayanan::STATUS_DITOLAK_KEPALA_UPT => 'Ditolak Kepala UPT',
            Pelayanan::STATUS_SETUJU_KEPALA_UPT => 'Disetujui Kepala UPT',
            Pelayanan::STATUS_VERIFIKASI_KASUBIT => 'Verifikasi Kasubit',
            Pelayanan::STATUS_DITOLAK_KASUBIT => 'Ditolak Kasubit',
            Pelayanan::STATUS_SETUJU_KASUBIT => 'Disetujui Kasubit',
            Pelayanan::STATUS_VERIFIKASI_KABIT => 'Verifikasi Kabit',
            Pelayanan::STATUS_DITOLAK_KABIT => 'Ditolak Kabit',
            Pelayanan::STATUS_SETUJU_KABIT => 'Disetujui Kabit',
        ];
    }
}