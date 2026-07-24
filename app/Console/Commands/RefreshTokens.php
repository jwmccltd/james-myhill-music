<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\SpotifyService;
use App\Services\SoundcloudService;
use App\Models\User;

class RefreshTokens extends Command
{
    public function __construct(protected SpotifyService $spotifyService, protected SoundcloudService $soundCloudService) {
        // Constructor
        parent::__construct();
    }
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:refresh-tokens';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $userId = User::value('id');
        $this->spotifyService->getSetAccessToken($userId, true);
        $this->soundCloudService->getSetAccessToken(true);
    }
}
