<?php

namespace Jisan\LaravelReadyModular\Generator\Generators\Crud;

use Illuminate\Support\Str;
use Jisan\LaravelReadyModular\Generator\Support\Stub;
use Jisan\LaravelReadyModular\Generator\Support\Filesystem;
use Jisan\LaravelReadyModular\Generator\Support\StubCompiler;
use Jisan\LaravelReadyModular\Generator\Context\ModuleContext;
use Jisan\LaravelReadyModular\Generator\Contracts\ConditionalGenerator;

class InterfaceGenerator implements ConditionalGenerator
{
    public function __construct(private Filesystem $fs) {}

     public function key(): string
    {
        return 'interface';
    }

      public function shouldRun(ModuleContext $context): bool
    {
        return $context->isLinkModule;
    }

    public function generate(ModuleContext $context): void
    {

        $stub = Stub::get("link/interface");
        $pluralParent = Str::plural($context->parentName); ;

        $content = StubCompiler::compile($stub, [
            'MODEL' => $context->name,
            'PARENT_MODEL' => $context->parentName,
            'PLURAL_PARENT_MODEL' => $pluralParent,
        ]);

        $this->ensureContractsDirectory($context->path);

        $this->fs->put(
            "{$context->path}/Contracts/{$context->parentName}ServiceInterface.php",
            $content
        );
    }

    private function ensureContractsDirectory(string $modulePath): void
    {
        $dir = "{$modulePath}/Contracts";

        if (! $this->fs->exists($dir)) {
            $this->fs->makeDir($dir);
        }
    }
}
