<sitemapindex xmlns:image="http://www.google.com/schemas/sitemap-image/1.1" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:news="http://www.google.com/schemas/sitemap-news/0.9">
	<sitemap><loc>{{ url('sitemap/archive/sitemap.xml') }}</loc></sitemap>
	<sitemap><loc>{{ url('sitemap/tags/sitemap.xml') }}</loc></sitemap>
@foreach($tags as $tag)
	<sitemap><loc>{{ url('sitemap/'.$tag['id'].'/sitemap.xml') }}</loc></sitemap>
@endforeach
</sitemapindex>