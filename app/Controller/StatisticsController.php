<?php
class StatisticsController extends AppController {
	public $name = 'Statistics';
	public $uses = array('UtmData');
	public $helpers = array('Html', 'Form', 'Paginator');
	public $components = array('Paginator');

	public $paginate = array(
		'limit' =>	 20,
		'order' => array(
			'UtmData.source' => 'asc'
		)
	);

	public function utm_list() {
		$page = isset($this->request->params['named']['page']) ?
			$this->request->params['named']['page'] : 1;

		$treeData = $this->UtmData->getTreeData(20, $page);

		$totalSources = $this->UtmData->getSourceCount();

		$this->set('treeData', $treeData);
		$this->set('totalSources', $totalSources);
		$this->set('currentPage', $page);
		$this->set('totalPages', ceil($totalSources / 20));
	}
}
