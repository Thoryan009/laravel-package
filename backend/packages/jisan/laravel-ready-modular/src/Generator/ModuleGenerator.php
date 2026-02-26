<?php

namespace Jisan\LaravelReadyModular\Generator;

use Jisan\LaravelReadyModular\Generator\Context\ModuleContext;
use Jisan\LaravelReadyModular\Generator\ServiceTypes\ServiceGeneratorContract;

class ModuleGenerator
{
    public function __construct(
        private array $modules,
        private array $services
    ) {}

    public function generate(ModuleContext $context): void
    {

        // Resolve the service strategy
        $serviceStrategy = $this->services[$context->serviceType];

        if ($context->isSubEntity()) {
            $this->appendSubEntityRoutes($context);
        }
        // First, generate the service file
        $serviceStrategy->generate($context);

        // Then generate module files & controller using this service
        $this->modules[$context->moduleType]->generate($context, $serviceStrategy);
    }

    public function getServiceStrategy(string $type): ServiceGeneratorContract
    {
        return $this->services[$type];
    }

    // private function appendSubEntityRoutes(ModuleContext $context): void
    // {
    //     $routePath = base_path("app/Modules/{$context->parentName}/Routes/api.php");

    //     if (!file_exists($routePath)) {
    //         return;
    //     }

    //     $entity = $context->name;
    //     $entityPlural = str()->kebab(str()->pluralStudly($entity));
    //     $controller = "{$entity}Controller";

    //     $routeContent = "\n";
    //     $routeContent .= "Route::apiResource('{$entityPlural}', {$controller}::class);\n";
    //     $routeContent .= "Route::post('{$entityPlural}/bulk-delete', [{$controller}::class, 'bulkDelete']);\n";

    //     file_put_contents($routePath, $routeContent, FILE_APPEND);
    // }

   private function appendSubEntityRoutes(ModuleContext $context): void
    {
        $routePath = base_path("app/Modules/{$context->parentName}/Routes/api.php");
        if (! file_exists($routePath)) {
            $this->warn("⚠️ api.php not found for module {$context->parentName}");
            return;
        }
        $entity = $context->name;
        $entityPlural = str()->kebab(str()->pluralStudly($entity));
        $controller = "{$entity}Controller";
        $controllerNamespace = "App\\Modules\\{$context->parentName}\\Controllers\\Api\\{$controller}";

        $content = file_get_contents($routePath);
        /*
        | 1️⃣ ADD USE STATEMENT (Proper Position)
        */
        $useLine = "use {$controllerNamespace};";
        if (! str_contains($content, $useLine)) {

            // Find last existing use statement
            preg_match_all('/^use .*;/m', $content, $matches);
            if (!empty($matches[0])) {
                $lastUse = end($matches[0]);
                $content = str_replace($lastUse, $lastUse . "\n" . $useLine, $content);
            } else {
                // If no use statement exists, add after <?php
                $content = preg_replace('/<\?php\s*/', "<?php\n\n{$useLine}\n\n", $content, 1);
            }
        }
        /*
        | 2️⃣ ADD ROUTES (Avoid Duplicate)
        */
        if (! str_contains($content, "{$controller}::class")) {
            $content .= "\nRoute::apiResource('{$entityPlural}', {$controller}::class);";
            $content .= "\nRoute::post('{$entityPlural}/bulk-delete', [{$controller}::class, 'bulkDelete']);\n";
        }
        file_put_contents($routePath, $content);
    }

}
