<?php

namespace Barryvdh\DomPDF\Support;

class SimplePdfGenerator
{
    public function fromHtml(string $html, string $paper = 'a4', string $orientation = 'portrait'): string
    {
        $normalizedHtml = preg_replace('/<\s*br\s*\/?\s*>/i', "\n", $html) ?? $html;
        $normalizedHtml = preg_replace('/<\s*\/p\s*>/i', "\n", $normalizedHtml) ?? $normalizedHtml;

        $text = trim($this->normalizeWhitespace(strip_tags($normalizedHtml)));
        $lines = $this->wrapText($text);

        $content = $this->buildContentStream($lines);

        $objects = [];
        $objects[] = "<< /Type /Catalog /Pages 2 0 R >>";
        $objects[] = "<< /Type /Pages /Kids [3 0 R] /Count 1 >>";
        $objects[] = "<< /Type /Page /Parent 2 0 R /MediaBox [0 0 595 842] /Contents 4 0 R /Resources << /Font << /F1 5 0 R >> >> >>";
        $objects[] = "<< /Length " . strlen($content) . " >>\nstream\n" . $content . "endstream";
        $objects[] = "<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica >>";

        $pdf = "%PDF-1.4\n";
        $offsets = [0];

        foreach ($objects as $index => $object) {
            $offsets[$index + 1] = strlen($pdf);
            $pdf .= ($index + 1) . " 0 obj\n" . $object . "\nendobj\n";
        }

        $xrefOffset = strlen($pdf);
        $pdf .= "xref\n0 " . (count($objects) + 1) . "\n";
        $pdf .= "0000000000 65535 f \n";

        for ($i = 1; $i <= count($objects); $i++) {
            $pdf .= sprintf("%010d 00000 n \n", $offsets[$i]);
        }

        $pdf .= "trailer\n<< /Size " . (count($objects) + 1) . " /Root 1 0 R >>\n";
        $pdf .= "startxref\n" . $xrefOffset . "\n";
        $pdf .= "%%EOF";

        return $pdf;
    }

    protected function normalizeWhitespace(string $text): string
    {
        return preg_replace('/\s+/u', ' ', $text) ?? '';
    }

    protected function wrapText(string $text): array
    {
        if ($text === '') {
            return [''];
        }

        $wrapped = wordwrap($text, 80, "\n", true);

        return explode("\n", $wrapped);
    }

    protected function escapeText(string $text): string
    {
        return str_replace(['\\', '(', ')'], ['\\\\', '\\(', '\\)'], $text);
    }

    protected function buildContentStream(array $lines): string
    {
        $stream = "BT\n/F1 12 Tf\n14 TL\n1 0 0 1 72 800 Tm\n";

        foreach ($lines as $index => $line) {
            if ($index !== 0) {
                $stream .= "T*\n";
            }

            $stream .= "(" . $this->escapeText($line) . ") Tj\n";
        }

        $stream .= "ET\n";

        return $stream;
    }
}