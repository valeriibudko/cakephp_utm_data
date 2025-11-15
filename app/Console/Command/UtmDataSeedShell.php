<?php
class UtmDataSeedShell extends AppShell {
	public $uses = array('UtmData');

	public function main() {
		$this->out('Start adding fixture for UTM data...');

		// Clean data
		$this->UtmData->deleteAll('1=1');

		$testData = array(
			array(
				'source' => 'google',
				'medium' => 'cpc',
				'campaign' => 'summer',
				'content' => 'banner',
				'term' => 'video'
			),
			array(
				'source' => 'google',
				'medium' => 'cpc',
				'campaign' => 'winter',
				'content' => 'delta',
				'term' => null
			),
			array(
				'source' => 'yandex',
				'medium' => 'cpc',
				'campaign' => 'spring',
				'content' => 'text',
				'term' => 'search'
			),
			array(
				'source' => 'facebook',
				'medium' => 'social',
				'campaign' => 'autumn',
				'content' => 'image',
				'term' => 'park'
			),
			array(
				'source' => 'twitter',
				'medium' => 'social',
				'campaign' => 'newyear',
				'content' => 'video',
				'term' => 'promo'
			),

			array(
				'source' => 'google',
				'medium' => 'organic',
				'campaign' => 'blog_content',
				'content' => 'article_1',
				'term' => 'cakephp_tutorial'
			),
			array(
				'source' => 'google',
				'medium' => 'organic',
				'campaign' => 'blog_content',
				'content' => 'article_2',
				'term' => 'php_frameworks'
			),
			array(
				'source' => 'google',
				'medium' => 'referral',
				'campaign' => 'partner_sites',
				'content' => 'techblog.com',
				'term' => null
			),

			array(
				'source' => 'yandex',
				'medium' => 'organic',
				'campaign' => 'seo_boost',
				'content' => null,
				'term' => 'php_development'
			),
			array(
				'source' => 'yandex',
				'medium' => 'organic',
				'campaign' => 'seo_boost',
				'content' => null,
				'term' => 'framework_comparison'
			),

			array(
				'source' => 'instagram',
				'medium' => 'social',
				'campaign' => 'q4_launch',
				'content' => 'story_video',
				'term' => null
			),
			array(
				'source' => 'instagram',
				'medium' => 'social',
				'campaign' => 'q4_launch',
				'content' => 'carousel_post',
				'term' => null
			),
			array(
				'source' => 'instagram',
				'medium' => 'social',
				'campaign' => 'influencer_collab',
				'content' => null,
				'term' => null
			),

			array(
				'source' => 'linkedin',
				'medium' => 'social',
				'campaign' => 'b2b_lead_gen',
				'content' => 'whitepaper_download',
				'term' => 'enterprise_cakephp'
			),

			array(
				'source' => 'email',
				'medium' => 'economics',
				'campaign' => 'newsletter_october',
				'content' => 'product_update',
				'term' => null
			),
			array(
				'source' => 'email',
				'medium' => 'music',
				'campaign' => 'newsletter_october',
				'content' => 'user_stories',
				'term' => null
			)
		);

		foreach ($testData as $data) {
			$this->UtmData->create();
			if ($this->UtmData->save($data)) {
				$this->out('Record added: ' . $data['source'] . ' - ' . $data['medium'] . ' - ' . $data['campaign']);
			} else {
				$this->out('Error adding record');
			}
		}

		$this->out('Finish success adding UTM data');
	}
}
