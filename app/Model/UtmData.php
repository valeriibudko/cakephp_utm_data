<?php

class UtmData extends AppModel
{
	public $name = 'UtmData';

	public $validate = array(
		'source' => array(
			'rule' => 'notBlank',
			'message' => 'Field source is required.'
		),
		'medium' => array(
			'rule' => 'notBlank',
			'message' => 'Field medium is required.'
		),
		'campaign' => array(
			'rule' => 'notBlank',
			'message' => 'Field campaign is required'
		)
	);


	/**
	 * Get tree structure UTM-data
	 *
	 * @param $limit
	 * @param $page
	 * @return array
	 */
	public function getTreeData($limit = 20, $page = 1)
	{
		$options = array(
			'fields' => array('UtmData.source'),
			'group' => array('UtmData.source'),
			'limit' => $limit,
			'page' => $page,
			'order' => array('UtmData.source' => 'ASC')
		);

		$sources = $this->find('list', $options);
		$result = array();
//		debug($this->getDataSource()->getLog()); //dev

		foreach ($sources as $sourceId => $source) {
			$result[$source] = array();

			// Get Medium for each source
			$mediums = $this->find('list', array(
				'fields' => array('UtmData.medium'),
				'group' => array('UtmData.medium'),
				'conditions' => array('UtmData.source' => $source),
				'order' => array('UtmData.medium' => 'ASC')
			));

			foreach ($mediums as $mediumId => $medium) {
				$result[$source][$medium] = array();

				// Get campaign for each medium
				$campaigns = $this->find('list', array(
					'fields' => array('UtmData.campaign'),
					'group' => array('UtmData.campaign'),
					'conditions' => array(
						'UtmData.source' => $source,
						'UtmData.medium' => $medium
					),
					'order' => array('UtmData.campaign' => 'ASC')
				));

				foreach ($campaigns as $campaignId => $campaign) {
					$result[$source][$medium][$campaign] = array();

					// get content for each campaign
					$contents = $this->find('list', array(
						'fields' => array('UtmData.content'),
						'group' => array('UtmData.content'),
						'conditions' => array(
							'UtmData.source' => $source,
							'UtmData.medium' => $medium,
							'UtmData.campaign' => $campaign
						),
						'order' => array('UtmData.content' => 'ASC')
					));

					foreach ($contents as $contentId => $content) {
						$result[$source][$medium][$campaign][$content] = array();

						// get term for content
						$terms = $this->find('list', array(
							'fields' => array('UtmData.term'),
							'group' => array('UtmData.term'),
							'conditions' => array(
								'UtmData.source' => $source,
								'UtmData.medium' => $medium,
								'UtmData.campaign' => $campaign,
								'UtmData.content' => $content
							),
							'order' => array('UtmData.term' => 'ASC')
						));

						foreach ($terms as $termId => $term) {
							$result[$source][$medium][$campaign][$content][] = $term;
						}
					}
				}
			}
		}

		return $result;
	}

	/**
	 * Get total count unique source
	 * @return array|int|null
	 */
	public function getSourceCount()
	{
		return $this->find('count', array(
			'fields' => array('UtmData.source'),
			'group' => array('UtmData.source')
		));
	}
}
