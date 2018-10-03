<?php
namespace Gt\Dom\Test;

use PHPUnit\Framework\TestCase;
use Gt\Dom\HTMLDocument;
use Gt\Dom\Test\Helper\Helper;

class FormTest extends TestCase {
	public function testMultipleRadioCanNotBeCheckedViaProperty() {
		$document = new HTMLDocument(Helper::HTML_FORM_WITH_RADIOS);
		$whiteRadio = $document->querySelector("input[value=white]");
		$blackRadio = $document->querySelector("input[value=black]");

		$whiteRadio->checked = true;

		self::assertTrue(
			$whiteRadio->hasAttribute("checked"),
			"Checked attribute should be present on white radio after setting property on white."
		);
		self::assertFalse(
			$blackRadio->hasAttribute("checked"),
			"Checked attribute should not be present on black radio after setting property on white."
		);

		$blackRadio->checked = true;

		self::assertFalse(
			$whiteRadio->hasAttribute("checked"),
			"Checked attribute should not be present on white after setting property on black."
		);
		self::assertTrue(
			$blackRadio->hasAttribute("checked"),
			"Checked attribute should be present on black after setting property on black."
		);
	}

	public function testMultipleSelectOptionCanNotBeCheckedViaProperty() {
		$document = new HTMLDocument(Helper::HTML_FORM_WITH_RADIOS);
		$under18option = $document->querySelector("option[value='0-17']");
		$youngAdultOption = $document->querySelector("option[value='18-35']");

		$under18option->selected = true;

		self::assertTrue($under18option->hasAttribute("selected"));
		self::assertFalse($youngAdultOption->hasAttribute("selected"));

		$youngAdultOption->selected = true;

		self::assertFalse($under18option->hasAttribute("selected"));
		self::assertTrue($youngAdultOption->hasAttribute("selected"));
	}
}