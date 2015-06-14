lib.nav.basket = HMENU
lib.nav.basket {
	special = list
	special.value = {$uid.pages.basket}

	1 = TMENU
	1{
		expAll = 1

		NO = 1
		NO {
			ATagBeforeWrap = 1
			allWrap = <div class="navbar-form navbar-right" role="search">|</div>
			linkWrap = <button class="btn btn-primary btn-basket" type="button"><span class="hidden-xs">|</span> <span id="basket-badge" class="badge">0</span></button>

		}

		ACT = 1
		ACT < .NO
		CUR = 1
		CUR < .NO
	}
}




