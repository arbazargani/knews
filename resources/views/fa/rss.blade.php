<rss version="2.0" xmlns:atom="https://www.w3.org/2005/Atom"
    xmlns:dc="https://purl.org/dc/elements/1.1/"
    xmlns:sy="https://purl.org/rss/1.0/modules/syndication/"
    xmlns:admin="https://webns.net/mvcb/"
    xmlns:rdf="https://www.w3.org/1999/02/22-rdf-syntax-ns#"
    xmlns:content="https://purl.org/rss/1.0/modules/content/">

    <channel>
        <title>{{ config('app.name') }} :: RSS</title>

        <link>{{ url('/') }}</link>
        <description>{{ config('app.name') }} </description>
        <dc:language>fa-ir</dc:language>
        <dc:creator>info@ketabnews.com ( {{ config('app.name') }} )</dc:creator>
        <dc:rights>Copyright {{ config('app.name') }}</dc:rights>
        <atom:link href="{{ url('/rss') }}" rel="self" type="application/rss+xml"/>

        @foreach($news as $val)
            <item>
                <title>{{ $val->title }}</title>
                <link></link>
                <guid>{{ route('news.show',[$val->id , str_slug_fa($val->title)]) }}</guid>
                <description><![CDATA[ {{ $val->descr }} ]]></description>
                <pubDate>{{ $val->created_at }}</pubDate>

            </item>
        @endforeach
    </channel>
</rss>