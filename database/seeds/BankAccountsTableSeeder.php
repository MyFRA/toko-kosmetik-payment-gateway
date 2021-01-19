<?php

use Illuminate\Database\Seeder;

use App\Models\BankAccount;

class BankAccountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bank_accounts = [
            [
                'bank_name'             => 'BRI',
                'bank_account_name'     => 'LISTIANTO',
                'bank_account_number'   => '687201023564539',
                'bank_logo'             => 'MzIaWJAJkMukWx1DmN6uz90AktEgbNSNdrtYJ2Yr.webp',
            ],
            [
                'bank_name'             => 'MANDIRI',
                'bank_account_name'     => 'DESI TRI HASTUTI',
                'bank_account_number'   => '1380012305590',
                'bank_logo'             => 'wJMVFD8ggObuilJnATyWesYSY4oRoBZXSB75TPJO.png',
            ]
        ];

        foreach ($bank_accounts as $bank_account) {
            BankAccount::create($bank_account);
        }
    }
}
