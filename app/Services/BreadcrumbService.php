<?php

namespace App\Services;

class BreadcrumbService
{
    /**
     * Crée un tableau de breadcrumb avec le format attendu
     *
     * @param array $items Les éléments du breadcrumb sous forme de tableau associatif
     * @return array
     */
    public static function make(array $items): array
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

        return $breadcrumb;
    }
}
