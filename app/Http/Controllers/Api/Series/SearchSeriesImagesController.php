<?php

namespace App\Http\Controllers\Api\Series;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Token;

class SearchSeriesImagesController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $contentTitle = $request->title;

        // TVDBへリクエスト
        $url = 'https://api4.thetvdb.com/v4/search?query=' . urlencode($contentTitle);

        $headers = array(
            'accept: application/json',
            'Authorization: Bearer eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCJ9.eyJhZ2UiOiIiLCJhcGlrZXkiOiI2NDI5MDNlOC1lNzBkLTRjYzAtYjdmYi03NzhkYTA5YmJjNjAiLCJjb21tdW5pdHlfc3VwcG9ydGVkIjp0cnVlLCJleHAiOjE2ODg4Mjg5OTQsImdlbmRlciI6IiIsImhpdHNfcGVyX2RheSI6MTAwMDAwMDAwLCJoaXRzX3Blcl9tb250aCI6MTAwMDAwMDAwLCJpZCI6IjI0Mjc5NzEiLCJpc19tb2QiOmZhbHNlLCJpc19zeXN0ZW1fa2V5IjpmYWxzZSwiaXNfdHJ1c3RlZCI6ZmFsc2UsInBpbiI6IjUwVkoyRUNTIiwicm9sZXMiOltdLCJ0ZW5hbnQiOiJ0dmRiIiwidXVpZCI6IiJ9.TNg1TOYBmF06vhJm9SFyB44bDhDpCUhkaYr1QJFKe-wziKu5lsjt7TjawLld9QlJTeyEDuvhCH2CHziEPrTL724qpFCkhOWGuIJ4rWNQwSx9ah7NOipnRB8zCa3-S0e5owRWtXXGIISmOMGb6sfNzsPuBKhMUZaKJWaqYvReVqRVLNur33__S-ecHWA2fyPjtjT_pr_6_hdKsmX29ngcRKY1p0HhveYOsHOerTXofSuBw8J2hO7mvlxfYwppIEjuFcTeaooh9CWFuI4XsDJR72-0UtrGMzL6F-OaT30azsYn4pAV--CuSPrZYxpEJeCs48iA4Nal79SRpPrB7z0ayGc23bX_xeDoOa8a0V5VVOxA3Key_6llKWUzK6H5Nb4SKjhBNkU_zCnxFJVUzpFktylT5uan8JChWbYlHVSgtqyjZhaYqKB0rrcsLz8zPAKJqoSQSxtoFLlg4e1EUNXUd9iy46tENfqxcU5Y1nrLnx8XHo8TWtVv1AlTA6ZlQolFq-ujjAHUMKS2yq5ySLT_RFRJ9zv70rkOaiSo-yWH665Inlk5OfLC4U1NFYajRgVWbWnphbSr9NfZB4EaMr4-t3ewqnBIYnkylV4eNQIvdgWshjHGXFczwAHUi3HVLh4uLFGc78WovCHx6EH_S0ha3PogruaPzP5wk4gNuPKV64I'
        );

        $options = array(
            'http' => array(
                'header' => implode("\r\n", $headers)
            )
        );
        $context = stream_context_create($options);

        $response = file_get_contents($url, false, $context);

        $results = json_decode($response, true);

        return $results;
    }
}
