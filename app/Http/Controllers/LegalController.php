<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;

class LegalController extends Controller
{
    public function privacy(): Response
    {
        $locale = app()->getLocale();
        $version = (string) config('legal.privacy.version');
        $documentPath = resource_path("legal/privacy-v{$version}.{$locale}.md");

        abort_unless(is_file($documentPath), 404);

        $content = Str::markdown((string) file_get_contents($documentPath), [
            'html_input' => 'strip',
            'allow_unsafe_links' => false,
        ]);

        return Inertia::render('Legal/Privacy', [
            'document' => [
                'content' => $content,
                'version' => $version,
                'publishedAt' => (string) config('legal.privacy.published_at'),
            ],
            'meta' => [
                'title' => __('legal.privacy_meta_title'),
                'description' => __('legal.privacy_meta_description'),
                'image' => asset('images/og-default.jpg'),
            ],
        ]);
    }
}
