<?php

namespace Jisan\LaravelReadyModular\Generator\Generators\Crud;

use Illuminate\Support\Str;
use Jisan\LaravelReadyModular\Generator\Support\Stub;
use Jisan\LaravelReadyModular\Generator\Support\Filesystem;
use Jisan\LaravelReadyModular\Generator\Support\StubCompiler;
use Jisan\LaravelReadyModular\Generator\Context\ModuleContext;
use Jisan\LaravelReadyModular\Generator\Contracts\ConditionalGenerator;

class RouteGenerator implements ConditionalGenerator
{
    public function __construct(private Filesystem $fs) {}

    public function key(): string
    {
        return 'route';
    }

     public function shouldRun(ModuleContext $context): bool
    {
        return !$context->isSubEntity;
    }

    public function generate(ModuleContext $context): void
    {
        $moduleType = $context->moduleType;
        if($context->isLinkModule){
            $moduleType = 'link';
        }
        $stub = Stub::get("{$moduleType}/route.api");

        $replacements = [
            'MODEL' => $context->name,
            'TABLE' => $context->table,
            'ROUTE_PARAM'  => strtolower($context->name),
        ];

        if($context->isLinkModule){
            $replacements['PLURAL_PARENT_MODEL'] = Str::plural($context->parentName);
            $replacements['plural_parent_model'] = Str::snake($context->parentName);
        }

        $content = StubCompiler::compile($stub,  $replacements);

        $this->ensureRouteDirectory($context->path);

        $this->fs->put(
            "{$context->path}/Routes/api.php",
            $content
        );
    }

    private function ensureRouteDirectory(string $modulePath): void
    {
        $dir = "{$modulePath}/Routes";

        if (! $this->fs->exists($dir)) {
            $this->fs->makeDir($dir);
        }
    }
}
