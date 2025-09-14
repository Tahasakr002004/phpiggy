<?php

declare(strict_types=1);

namespace Framework;

class TemplateEngine
{
    private array $globalTemplateData = [];

    public function __construct(private string $basePath)
    {
        // provide safe defaults so templates don't crash
        $this->globalTemplateData['errors'] = [];
        $this->globalTemplateData['oldFormData'] = [];
        $this->globalTemplateData['e'] = fn($v) => htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8');
    }

    public function render(string $template, array $data = []): string
    {
        extract($data, EXTR_SKIP);
        extract($this->globalTemplateData, EXTR_SKIP);

        ob_start();
        include "{$this->basePath}/{$template}";
        $output = ob_get_contents();
        ob_end_clean();

        return $output;
    }

    public function resolvePath(string $template): string
    {
        return rtrim($this->basePath, '/\\') . DIRECTORY_SEPARATOR . ltrim($template, '/\\');
    }

    public function addGlobalData(string $key, mixed $value): void
    {
        $this->globalTemplateData[$key] = $value;
    }
}
