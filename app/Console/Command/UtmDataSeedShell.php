<?php

class UtmDataSeedShell extends AppShell
{
	public $uses = array('UtmData');

	public function main()
	{
		$this->out('Start generate UTM data...');

		// Clean old data
		$this->UtmData->deleteAll('1=1');

		$sources = array(
			'google', 'yandex', 'bing', 'duckduckgo', 'baidu', 'yahoo',
			'facebook', 'instagram', 'twitter', 'linkedin', 'tiktok', 'pinterest', 'snapchat',
			'youtube', 'vimeo', 'twitch',
			'reddit', 'discord', 'telegram',
			'direct', 'email_marketing', 'qr_code_scanner',
			'partner_techcrunch', 'partner_wired', 'referral_forbes',
			'blog_smashingmagazine', 'blog_css_tricks', 'forum_stackoverflow',
			'offline_conference_2023', 'offline_webinar', 'offline_flyer'
		);

		$mediums = array('cpc', 'organic', 'social', 'email', 'referral', 'display', 'cpm');
		$campaigns_base = array('brand_awareness', 'lead_generation', 'product_launch', 'seasonal_sale', 'content_promo', 'user_re_engagement');
		$contents_base = array('video_ad', 'carousel_ad', 'story_post', 'banner_sidebar', 'blog_article', 'whitepaper', 'case_study', 'webinar_signup');
		$terms_base = array('php_framework', 'cakephp_tutorial', 'web_dev', 'mvc_pattern', 'backend_as_a_service', 'api_integration');

		$testData = array();
		$totalRecords = 0;

		foreach ($sources as $source) {
			$numRecordsForSource = rand(2, 5);

			for ($i = 0; $i < $numRecordsForSource; $i++) {
				$medium = $mediums[array_rand($mediums)];
				$campaign = $campaigns_base[array_rand($campaigns_base)] . '_' . date('Y');
				$content = $contents_base[array_rand($contents_base)];
				$term = $terms_base[array_rand($terms_base)];

				if (rand(0, 1)) {
					$term = null;
				}

				$testData[] = array(
					'source' => $source,
					'medium' => $medium,
					'campaign' => $campaign,
					'content' => $content,
					'term' => $term,
				);
			}
		}

		$successCount = 0;
		$failCount = 0;
		$totalToSave = count($testData);

		$this->out("Going to add {$totalToSave} records...");

		foreach ($testData as $i => $data) {
			$this->UtmData->create();
			if ($this->UtmData->save($data)) {
				$successCount++;
			} else {
				$failCount++;
				$this->err("Error: " . $data['source']);
			}

			if (($i + 1) % 20 == 0) {
				$this->out("Working " . ($i + 1) . " / {$totalToSave} records...");
			}
		}

		$this->out('');
		$this->out('---------------------------------------------------------------');
		$this->out("Added: {$successCount}");
		$this->out("Errors: {$failCount}");
		$this->out("Uniq: " . count($sources));
		$this->out('---------------------------------------------------------------');
	}
}
