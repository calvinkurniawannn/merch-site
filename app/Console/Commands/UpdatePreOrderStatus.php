<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PreOrderCampaign;
use Carbon\Carbon;

class UpdatePreOrderStatus extends Command
{
    protected $signature = 'preorder:update-status';
    protected $description = 'Update PreOrderCampaign status jadi 0 kalau udah lewat end_date';

    public function handle()
    {
        $now = Carbon::now();

        // Update semua campaign yang sudah lewat end_date dan masih aktif
        $updated = PreOrderCampaign::where('end_date', '<', $now)
            ->where('status', 1)
            ->update(['status' => 0]);

        $this->info("✅ $updated Pre Order Campaign berhasil di-update jadi status 0.");
    }
}