@extends('layouts.main')

@section('content')

<div class="container-fluid" id="latest">
    <div class="container pt-5 pb-5">
        <div class="row">
            <div class="col-12">
                <h2>Alt Electric</h2>
                <p>Electronic based music, vocal and instrumental with an alternative edge.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-4 mb-2">
                <img src="/images/playlists/alt-electric.jpg" width="100%" />
            </div>
            <div class="col-12 col-md-8">
                <div>
                    <iframe data-testid="embed-iframe" style="border-radius:12px" src="https://open.spotify.com/embed/playlist/4BAeIqII4WGepTDXgr5Bv8?utm_source=generator" width="100%" height="152" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection