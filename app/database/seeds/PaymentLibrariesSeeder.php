<?php

class PaymentLibrariesSeeder extends Seeder
{

	public function run()
	{
		Eloquent::unguard();

		$gateways = [
			array('name'=>'BeanStream', 'provider'=>'BeanStream', 'payment_library_id' => 2),
			array('name'=>'Psigate', 'provider'=>'Psigate', 'payment_library_id' => 2)
		];
		
		foreach ($gateways as $gateway)
		{
			Gateway::create($gateway);
		}

		// check that moolah exists
		if (!DB::table('gateways')->where('name', '=', 'moolah')->get())	{
			DB::table('gateways')->update(['recommended' => 0]);
			DB::table('gateways')->insert([
				'name' => 'moolah',
				'provider' => 'AuthorizeNet_AIM',
				'sort_order' => 1,
				'recommended' => 1,
				'site_url' => 'https://invoiceninja.mymoolah.com/',
				'payment_library_id' => 1
			]);
		}

		/*
		$updateProviders = array(
			0 => 'AuthorizeNet_AIM', 
			//1 => 'BeanStream', 
			//2 => 'iTransact', 
			//3 => 'FirstData_Connect', 
			4 => 'PayPal_Pro', 
			5 => 'TwoCheckout'
		);

		Gateway::whereIn('provider', $updateProviders)->update(array('recommended' => 1));
		
		Gateway::where('provider', '=', 'AuthorizeNet_AIM')->update(array('sort_order' => 5, 'site_url' => 'http://reseller.authorize.net/application/?id=5560364'));
		//Gateway::where('provider', '=', 'BeanStream')->update(array('sort_order' => 10, 'site_url' => 'http://www.beanstream.com/'));
		//Gateway::where('provider', '=', 'FirstData_Connect')->update(array('sort_order' => 20, 'site_url' => 'https://www.firstdata.com/'));
		Gateway::where('provider', '=', 'PayPal_Pro')->update(array('sort_order' => 25, 'site_url' => 'https://www.paypal.com/'));
		Gateway::where('provider', '=', 'TwoCheckout')->update(array('sort_order' => 30, 'site_url' => 'https://www.2checkout.com/referral?r=2c37ac2298'));
		*/

	}
}