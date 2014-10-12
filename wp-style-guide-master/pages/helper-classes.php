<div class="wrap">
	<?php screen_icon(); ?>

	<h2><?php esc_html_e( 'Color Helper Classes' ); ?></h2>

	<div class="mp6-sg-example">
		<h3>Blocks</h3>

		<table class="mp6-table">
		<thead>
			<tr>
				<th class="sg-example-code"><?php esc_html_e( 'Class' ); ?></th>
				<th class="sg-example-descrip"><?php esc_html_e( 'Description' ); ?></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><code>.mp6-primary</code></td>
				<td><span class="mp6-primary"><?php esc_html_e( "Text with this class uses the base color." ); ?></span></td>
			</tr>
			<tr>
				<td><code>.mp6-highlight</code></td>
				<td><span class="mp6-highlight"><?php esc_html_e( "Text with this class uses the highlight color." ); ?></span></td>
			</tr>
			<tr>
				<td><code>.mp6-notification</code></td>
				<td><span class="mp6-notification"><?php esc_html_e( "Text with this class uses the notification color." ); ?></span></td>
			</tr>
		</tbody>
	</table>
	</div>

	<div class="mp6-sg-example">
		<h3>Text</h3>

		<table class="mp6-table">
		<thead>
			<tr>
				<th class="sg-example-code"><?php esc_html_e( 'Class' ); ?></th>
				<th class="sg-example-descrip"><?php esc_html_e( 'Description' ); ?></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><code>.mp6-text-primary</code></td>
				<td><span class="mp6-text-primary"><?php esc_html_e( "Text with this class uses the base color." ); ?></span></td>
			</tr>
			<tr>
				<td><code>.mp6-text-highlight</code></td>
				<td><span class="mp6-text-highlight"><?php esc_html_e( "Text with this class uses the highlight color." ); ?></span></td>
			</tr>
			<tr>
				<td><code>.mp6-text-notification</code></td>
				<td><span class="mp6-text-notification"><?php esc_html_e( "Text with this class uses the notification color." ); ?></span></td>
			</tr>
			<tr>
				<td><code>.mp6-text-icon</code></td>
				<td><span class="mp6-text-icon"><?php esc_html_e( "Text with this class uses the icon color." ); ?></span></td>
			</tr>
		</tbody>
	</table>
	</div>

	<div class="mp6-sg-example">
		<h3>Dashicons</h3>
		<h4 class="icon-dashicon"><?php esc_html_e( "This heading has an icon." ); ?></h4>
		<pre><code>&lt;h4 class="icon-dashicon"&gt;<?php esc_html_e( "This heading has an icon." ); ?>&lt;/h4&gt;</code></pre>
		<p>Add an icon to things using <code>.icon-dashicon</code> and overwrite the <code>content</code> property with a value from the <a href="http://melchoyce.github.io/dashicons/">Dashicons reference page</a>.</p>
	</div>

</div><!-- .wrap -->
