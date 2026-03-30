@extends('layouts.main')

@section('content')

<div class="container-fluid" id="latest">
    <div class="container pt-5 pb-5">
        <div class="row">
            <div class="col-12">
                <h2>In The Electronica Zone</h2>
                <p>Music for focus, coding, mental stimulation. Instrumental or minimal vocals with electronic foundations.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-4 mb-2">
                <img src="/images/playlists/in-the-zone.jpg" width="100%" />
            </div>
            <div class="col-12 col-md-8">
                <div>
                    <iframe data-testid="embed-iframe" style="border-radius:12px" src="https://open.spotify.com/embed/playlist/3B5O5ZcPfw2hAtLliVfvnu?utm_source=generator" width="100%" height="152" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
                    <iframe width="100%" height="300" scrolling="no" frameborder="no" allow="autoplay" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/playlists/soundcloud%253Aplaylists%253A2214184115&color=%23ff5500&auto_play=false&hide_related=false&show_comments=true&show_user=true&show_reposts=false&show_teaser=true"></iframe><div style="font-size: 10px; color: #cccccc;line-break: anywhere;word-break: normal;overflow: hidden;white-space: nowrap;text-overflow: ellipsis; font-family: Interstate,Lucida Grande,Lucida Sans Unicode,Lucida Sans,Garuda,Verdana,Tahoma,sans-serif;font-weight: 100;"><a href="https://soundcloud.com/jwmyhill" title="James Myhill" target="_blank" style="color: #cccccc; text-decoration: none;">James Myhill</a> · <a href="https://soundcloud.com/jwmyhill/sets/in-the-electronica-zone" title="In The Electronica Zone" target="_blank" style="color: #cccccc; text-decoration: none;">In The Electronica Zone</a></div>
            </div>
        </div>
    </div>
</div>

@endsection

