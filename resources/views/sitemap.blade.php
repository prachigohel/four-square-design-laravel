<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xhtml="http://www.w3.org/1999/xhtml">

    <url>
        <loc>{{ url('/') }}</loc>
        <changefreq>weekly</changefreq>
        <priority>1.0</priority>
        <lastmod>{{ now()->toAtomString() }}</lastmod>
    </url>

    <url>
        <loc>{{ url('/services') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.9</priority>
        <lastmod>{{ now()->toAtomString() }}</lastmod>
    </url>

    <url>
        <loc>{{ url('/portfolio') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.9</priority>
        <lastmod>{{ now()->toAtomString() }}</lastmod>
    </url>

    <url>
        <loc>{{ url('/contact') }}</loc>
        <changefreq>yearly</changefreq>
        <priority>0.7</priority>
        <lastmod>{{ now()->toAtomString() }}</lastmod>
    </url>

    <url>
        <loc>{{ url('/request') }}</loc>
        <changefreq>yearly</changefreq>
        <priority>0.6</priority>
        <lastmod>{{ now()->toAtomString() }}</lastmod>
    </url>

</urlset>
