{!! '<'.'?'.'xml version="1.0" encoding="UTF-8" ?>' !!}
<rss version="2.0"
    xmlns:content="http://purl.org/rss/1.0/modules/content/"
    xmlns:dc="http://purl.org/dc/elements/1.1/"
    xmlns:media="http://search.yahoo.com/mrss/"
    xmlns:atom="http://www.w3.org/2005/Atom"
    xmlns:georss="http://www.georss.org/georss">
    <channel>
        <title>{!! $channel['title'] !!}</title>
        <link>{{ $channel['rssLink'] }}</link>
        <description><![CDATA[{!! $channel['description'] !!}]]></description>
        <language>ru</language>
        @foreach($items as $item)
        <item>
           <title><![CDATA[{!! $item['title'] !!}]]></title>
           <link>{{ $item['link'] }}</link>
           <pubDate><? $date = new DateTime( $item['pubdate']); echo $date->format(DateTime::RFC822); ?></pubDate>
           <media:rating scheme="urn:simple">nonadult</media:rating>
           <author>CYBERSLOVO</author>
           <category>Игры</category>
           @if (!empty($item['enclosure']))
            <enclosure
            @foreach ($item['enclosure'] as $k => $v)
              {!! $k.'="'.$v.'" ' !!}
            @endforeach
            />
          @endif
          <description><![CDATA[{!! $item['description'] !!}]]></description>
          <content:encoded><![CDATA[{!! $item['content'] !!}]]></content:encoded>
        </item>
        @endforeach
    </channel>
</rss>