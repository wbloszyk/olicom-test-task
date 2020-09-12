lint: lint-yaml lint-xml lint-php
.PHONY: lint

lint-yaml:
	yaml-lint --ignore-non-yaml-files --quiet --exclude vendor .

.PHONY: lint-yaml

lint-xml:
	find . \( -name '*.xml' -or -name '*.xliff' \) \
		-not -path './vendor/*' \
		-not -path './src/Resources/public/vendor/*' \
        -not -path './public/*' \
		| while read xmlFile; \
	do \
		XMLLINT_INDENT='    ' xmllint --encode UTF-8 --format "$$xmlFile"|diff - "$$xmlFile"; \
		if [ $$? -ne 0 ] ;then exit 1; fi; \
	done

.PHONY: lint-xml

lint-php:
	php-cs-fixer fix --ansi --verbose --diff --dry-run
.PHONY: lint-php
