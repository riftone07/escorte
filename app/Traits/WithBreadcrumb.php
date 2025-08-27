<?php

namespace App\Traits;

trait WithBreadcrumb
{
    /**
     * Ajoute les données du breadcrumb à la vue
     *
     * @param array $items Les éléments du breadcrumb
     * @param array $data Données supplémentaires à passer à la vue
     * @return array
     */
    protected function withBreadcrumb(array $items, array $data = []): array
    {
        $breadcrumb = [];
        
        foreach ($items as $title => $route) {
            if (is_numeric($title) && is_array($route) && isset($route['title'], $route['url'])) {
                // Format déjà correct
                $breadcrumb[] = $route;
            } else {
                // Format simple titre => route
                $breadcrumb[] = [
                    'title' => $title,
                    'url' => $route
                ];
            }
        }
        
        return array_merge(['breadcrumb' => $breadcrumb], $data);
    }
}