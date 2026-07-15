<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Adminwallet;


class UpdateWalletBalance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wallet:update-balance';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update wallet balance for users with wallet_linking field';

    /**
     * Execute the console command.
     */
    // public function handle()
    // {
    //     // Define the amount to add
    //     //$amountToAdd = 100; // Example amount

    //     $amountToAdd = Adminwallet::whereNotNull('daily_earning')->get();

    //     // Fetch all users with a value in wallet_linking
    //     $users = User::whereNotNull('wallet_linking')->get();

    //     foreach ($users as $user) {
    //         $user->walletbalance += $amountToAdd;
    //         $user->save();
    //         $this->info("Updated wallet balance for user ID: {$user->id}");
    //     }

    //     $this->info("Wallet balance update completed.");
    //     return Command::SUCCESS;
    // }
    public function handle()
    {
        // Fetch the daily earning amount from Adminwallet (assuming one row has this value)
        $adminWallet = Adminwallet::whereNotNull('daily_earning')->first();

        if (!$adminWallet || !is_numeric($adminWallet->daily_earning)) {
            $this->error('Daily earning amount not found or is invalid.');
            return Command::FAILURE;
        }

        $amountToAdd = (float)$adminWallet->daily_earning;

        // Fetch all users with a value in wallet_linking
        $users = User::whereNotNull('wallet_linking')->get();

        foreach ($users as $user) {
            // Ensure walletbalance is numeric before adding
            $user->walletbalance = (float)$user->walletbalance + $amountToAdd;
            $user->save();
            $this->info("Updated wallet balance for user ID: {$user->id}");
        }

        $this->info("Wallet balance update completed.");
        return Command::SUCCESS;
    }
}
