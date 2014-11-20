lib.template.main = FLUIDTEMPLATE
lib.template.main {
	file = {$path.res}html/page/Templates/default.html
	partialRootPath = {$path.res}html/page/Partials/
	layoutRootPath = {$path.res}html/page/Layouts/
}

lib.template.main >
lib.template.main = TEXT
lib.template.main {
	value = Hallo Welt!
}