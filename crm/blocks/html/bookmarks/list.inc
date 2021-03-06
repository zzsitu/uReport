<?php
/**
 * @copyright 2013 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE.txt
 * @author Cliff Ingham <inghamn@bloomington.in.gov>
 * @param BookmarkList $this->bookmarks
 */
$title = !empty($this->title) ? View::escape($this->title) : 'Saved Searchs';
if (count($this->bookmarks)) {
	echo "
	<div class=\"bookmarkList\">
		<h3>$title</h3>
		<ul>
 	";
		foreach ($this->bookmarks as $bookmark) {
			$name = View::escape($bookmark->getName());
			echo "
			<li><a href=\"{$bookmark->getRequestUri()}\">$name</a>
				<a class=\"icon-remove\"
					href=\"".BASE_URI."/bookmarks/delete?bookmark_id={$bookmark->getId()};return_url=$_SERVER[REQUEST_URI]\">
					<span class=\"hidden-label\">Delete</span>
				</a>
			</li>
			";
		}
	echo "
		</ul>
	</div>
	";
}
