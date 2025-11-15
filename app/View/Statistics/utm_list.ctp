<div class="statistics index">
	<h2><?php echo __('UTM Data Tree'); ?></h2>

	<?php if (!empty($treeData)): ?>
		<div class="utm-tree">
			<?php foreach ($treeData as $source => $mediums): ?>
				<div class="tree-node source-node">
					<div class="node-header">
						<span class="toggle">▼</span>
						<i class="icon">🌐</i>
						<span class="node-title"><?php echo h($source); ?></span>
					</div>
					<div class="tree-children">
						<?php if (!empty($mediums)): ?>
							<?php foreach ($mediums as $medium => $campaigns): ?>
								<div class="tree-node medium-node">
									<div class="node-header">
										<span class="toggle">▼</span>
										<i class="icon">📡</i>
										<span class="node-title"><?php echo h($medium); ?></span>
									</div>
									<div class="tree-children">
										<?php if (!empty($campaigns)): ?>
											<?php foreach ($campaigns as $campaign => $contents): ?>
												<div class="tree-node campaign-node">
													<div class="node-header">
														<span class="toggle">▼</span>
														<i class="icon">📢</i>
														<span class="node-title"><?php echo h($campaign); ?></span>
													</div>
													<div class="tree-children">
														<?php if (!empty($contents)): ?>
															<?php foreach ($contents as $content => $terms): ?>
																<div class="tree-node content-node">
																	<div class="node-header">
																		<span class="toggle">▼</span>
																		<i class="icon">📄</i>
																		<span class="node-title">
                                                                            <?php
																			if ($content === null) {
																				echo '<span class="null-value">NULL</span>';
																			} else {
																				echo h($content);
																			}
																			?>
                                                                        </span>
																	</div>
																	<div class="tree-children">
																		<?php if (!empty($terms)): ?>
																			<?php foreach ($terms as $term): ?>
																				<div class="tree-node term-node">
																					<div class="node-header">
																						<i class="icon">🔑</i>
																						<span class="node-title">
                                                                                            <?php
																							if ($term === null) {
																								echo '<span class="null-value">NULL</span>';
																							} else {
																								echo h($term);
																							}
																							?>
                                                                                        </span>
																					</div>
																				</div>
																			<?php endforeach; ?>
																		<?php endif; ?>
																	</div>
																</div>
															<?php endforeach; ?>
														<?php endif; ?>
													</div>
												</div>
											<?php endforeach; ?>
										<?php endif; ?>
									</div>
								</div>
							<?php endforeach; ?>
						<?php endif; ?>
					</div>
				</div>
			<?php endforeach; ?>
		</div>

		<!-- Пагинация -->
		<div class="pagination">
			<?php
			if ($currentPage > 1) {
				echo $this->Html->link('← Предыдущая', array(
					'page' => $currentPage - 1
				), array('class' => 'prev'));
			}

			for ($i = 1; $i <= $totalPages; $i++) {
				if ($i == $currentPage) {
					echo '<span class="current">' . $i . '</span>';
				} else {
					echo $this->Html->link($i, array('page' => $i));
				}
			}

			if ($currentPage < $totalPages) {
				echo $this->Html->link('Следующая →', array(
					'page' => $currentPage + 1
				), array('class' => 'next'));
			}
			?>
		</div>
	<?php else: ?>
		<p class="no-data"><?php echo __('No UTM data'); ?></p>
	<?php endif; ?>
</div>

<style>
	/* --- Basic style --- */
	.statistics {
		font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
		color: #333;
		line-height: 1.6;
	}

	.utm-tree {
		margin-top: 20px;
	}

	.tree-node {
		margin-bottom: 5px;
	}

	.node-header {
		display: flex;
		align-items: center;
		padding: 8px 12px;
		border-radius: 5px;
		cursor: pointer;
		transition: background-color 0.2s ease-in-out;
	}

	.node-header:hover {
		background-color: #f0f0f0;
	}

	.node-title {
		font-weight: 500;
		margin-left: 8px;
	}

	.tree-children {
		margin-left: 28px;
		position: relative;
	}

	/* Vertical line connection */
	.tree-children::before {
		content: '';
		position: absolute;
		left: 8px;
		top: -5px;
		bottom: 10px;
		width: 1px;
		background-color: #ddd;
	}

	.toggle {
		width: 16px;
		text-align: center;
		color: #777;
		font-size: 0.8em;
		transition: transform 0.2s ease-in-out;
	}

	.collapsed > .node-header .toggle {
		transform: rotate(-90deg);
	}

	.collapsed > .tree-children {
		display: none;
	}

	.null-value {
		background-color: #e9ecef;
		color: #6c757d;
		padding: 2px 6px;
		border-radius: 3px;
		font-size: 0.9em;
		font-style: italic;
	}

	/* --- Style each level --- */
	.source-node > .node-header { background-color: #e7f3ff; border-left: 4px solid #007bff; }
	.source-node > .node-header .icon { color: #0056b3; }

	.medium-node > .node-header { background-color: #eef9f0; border-left: 4px solid #28a745; }
	.medium-node > .node-header .icon { color: #1e7e34; }

	.campaign-node > .node-header { background-color: #fff8e1; border-left: 4px solid #ffc107; }
	.campaign-node > .node-header .icon { color: #d39e00; }

	.content-node > .node-header { background-color: #f3e5f5; border-left: 4px solid #e83e8c; }
	.content-node > .node-header .icon { color: #a61e4d; }

	.term-node > .node-header { background-color: #f8f9fa; border-left: 4px solid #6c757d; }
	.term-node > .node-header .icon { color: #495057; }


	/* --- Стили для пагинации --- */
	.pagination {
		margin-top: 30px;
		text-align: center;
		padding-top: 20px;
		border-top: 1px solid #eee;
	}

	.pagination a, .pagination span {
		display: inline-block;
		padding: 8px 12px;
		margin: 0 4px;
		border: 1px solid #ddd;
		border-radius: 4px;
		text-decoration: none;
		color: #007bff;
		transition: all 0.2s ease-in-out;
	}

	.pagination a:hover {
		background-color: #e9ecef;
		border-color: #adb5bd;
	}

	.pagination .current {
		background-color: #007bff;
		color: white;
		border-color: #007bff;
		font-weight: bold;
	}

	.no-data {
		text-align: center;
		color: #6c757d;
		font-style: italic;
		margin-top: 40px;
	}
</style>

<script>
	document.addEventListener('DOMContentLoaded', function() {
		const toggles = document.querySelectorAll('.toggle');

		toggles.forEach(toggle => {
			toggle.addEventListener('click', function(e) {
				e.stopPropagation(); // Fix for parent header
				const node = this.closest('.tree-node');
				node.classList.toggle('collapsed');
			});
		});
	});
</script>
