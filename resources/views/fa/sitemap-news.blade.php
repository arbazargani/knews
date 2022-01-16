<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
	<url>
		<loc>{{ url('/') }}</loc>
		<changefreq>always</changefreq>
		<priority>1</priority>
	</url>
@foreach($tags as $tag)
	<url>
		<loc>{{ url('news/'.$tag['id'].'/'.str_slug_fa($tag['title'])) }}</loc>
		<changefreq>always</changefreq>
		<priority>0.85</priority>
	</url>
@endforeach
	<url>
		<loc>{{ url('archive') }}</loc>
		<changefreq>always</changefreq>
		<priority>0.50</priority>
	</url>
</urlset>