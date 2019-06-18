<?php

namespace Drupal\test\Plugin\Field\FieldFormatter;

use Drupal\Component\Utility\Html;
use Drupal\Core\Field\FieldItemInterface;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'test_field_formatter' formatter.
 *
 * @FieldFormatter(
 *   id = "test_field_formatter",
 *   label = @Translation("Test field formatter"),
 *   field_types = {
 *     "text"
 *   }
 * )
 */
class TestFieldFormatter extends FormatterBase {

    /**
     * {@inheritdoc}
     */
    public static function defaultSettings() {
        return [
                // Implement default settings.
                ] + parent::defaultSettings();
    }

    /**
     * {@inheritdoc}
     */
    public function settingsForm(array $form, FormStateInterface $form_state) {
        return [
                // Implement settings form.
                ] + parent::settingsForm($form, $form_state);
    }

    /**
     * {@inheritdoc}
     */
    public function settingsSummary() {
        $summary = [];
        // Implement settings summary.

        return $summary;
    }

    /**
     * {@inheritdoc}
     */
    public function viewElements(FieldItemListInterface $items, $langcode) {
        $elements = [];
        foreach ($items as $delta => $item) {
            /* Fetching Giphy gif using artical title */
            $url = "http://api.giphy.com/v1/gifs/search?q=" . urlencode($this->viewValue($item)) . "&api_key=dacb3yH3ANHHu01N3CnIWWsb8yxPtm3t&limit=1";
            $result_giphy = json_decode(file_get_contents($url));
            $artical_image_title = $this->viewValue($item);
            if ($result_giphy->data[0]) {
                $artical_image_title = "<img src='" . $result_giphy->data[0]->images->preview_gif->url . "' alt='" . $this->viewValue($item) . "' height='42' width='42'>";
            }
            /* Fetching Giphy gif using artical title */
            $elements[$delta] = ['#markup' => $artical_image_title];
        }

        return $elements;
    }

    /**
     * Generate the output appropriate for one field item.
     *
     * @param \Drupal\Core\Field\FieldItemInterface $item
     *   One field item.
     *
     * @return string
     *   The textual output generated.
     */
    protected function viewValue(FieldItemInterface $item) {
        // The text value has no text format assigned to it, so the user input
        // should equal the output, including newlines.
        return nl2br(Html::escape($item->value));
    }

}
