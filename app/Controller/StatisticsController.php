<?php
class StatisticsController extends AppController {
	const PAGE_LIMIT = 20;

	public $name = 'Statistics';
	public $uses = array('UtmData');
	public $helpers = array('Html', 'Form', 'Paginator');
	public $components = array('Paginator');

	public $paginate = array(
		'limit' => self::PAGE_LIMIT,
		'order' => array(
			'UtmData.source' => 'asc'
		)
	);

	public function utm_list() {
		$page = isset($this->request->params['named']['page']) ?
			$this->request->params['named']['page'] : 1;

		$treeData = $this->UtmData->getTreeData(self::PAGE_LIMIT, $page);

		$totalSources = $this->UtmData->getSourceCount();

		$this->set('treeData', $treeData);
		$this->set('totalSources', $totalSources);
		$this->set('currentPage', $page);
		$this->set('totalPages', ceil($totalSources / self::PAGE_LIMIT));
	}
}
