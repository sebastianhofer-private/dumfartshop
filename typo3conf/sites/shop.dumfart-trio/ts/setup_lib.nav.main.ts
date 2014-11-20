/**
 * Main navigation
 *
 * @description		main navigation
 */
lib.nav.main = HMENU
lib.nav.main {
	entryLevel = 0
	1 = TMENU
	1 {
		noBlur = 1
		wrap = <ul>|</ul>
		NO = 1
		NO.wrapItemAndSub = <li>|</li>

		ACT < .NO
		ACT.wrapItemAndSub = <li class="active">|</li>
	}
}