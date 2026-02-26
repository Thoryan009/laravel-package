<?php

namespace Jisan\LaravelReadyModular\Generator\Generators\Crud;

use Illuminate\Support\Str;
use Jisan\LaravelReadyModular\Generator\Support\Stub;
use Jisan\LaravelReadyModular\Generator\Support\Filesystem;
use Jisan\LaravelReadyModular\Generator\Support\StubCompiler;
use Jisan\LaravelReadyModular\Generator\Context\ModuleContext;
use Jisan\LaravelReadyModular\Generator\Contracts\ConditionalGenerator;

class DbServiceGenerator implements ConditionalGenerator
{
    public function __construct(private Filesystem $fs) {}

     public function key(): string
    {
        return 'db_service';
    }

      public function shouldRun(ModuleContext $context): bool
    {
        return $context->isLinkModule;
    }


    public function generate(ModuleContext $context): void
    {

        $stub = Stub::get("link/db_service");
        $pluralParent = Str::plural($context->parentName); ;

        $content = StubCompiler::compile($stub, [
            'MODEL' => $context->name,
            'PARENT_MODEL' => $context->parentName,
            'PLURAL_PARENT_MODEL' => $pluralParent,
            'plural_parent_model' => Str::snake($pluralParent),
            'model' => Str::snake($context->name),
        ]);

        $this->ensureServicesDirectory($context->path);

        $this->fs->put(
            "{$context->path}/Services/{$context->parentName}DbService.php",
            $content
        );
    }

    private function ensureServicesDirectory(string $modulePath): void
    {
        $dir = "{$modulePath}/Services";

        if (! $this->fs->exists($dir)) {
            $this->fs->makeDir($dir);
        }
    }
}
