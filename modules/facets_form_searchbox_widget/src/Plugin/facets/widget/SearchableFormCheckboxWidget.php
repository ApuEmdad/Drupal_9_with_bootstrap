<?php

namespace Drupal\facets_form_searchbox_widget\Plugin\facets\widget;

use Drupal\facets\FacetInterface;
use Drupal\Component\Serialization\Json;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Render\RendererInterface;
use Drupal\facets_form\FacetsFormWidgetTrait;
use Drupal\facets_form\FacetsFormWidgetInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Render\Markup;
use Drupal\facets_form\Plugin\facets\widget\CheckboxWidget;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Extend the original class and implement facets_form interface.
 *
 * @FacetsWidget(
 *   id = "facets_form_searchable_checkbox",
 *   label = @Translation("Searchable Checkboxes (inside form)"),
 *   description = @Translation("A configurable widget that shows checkboxes as a form element and provides a search input."),
 * )
 */
class SearchableFormCheckboxWidget extends CheckboxWidget implements FacetsFormWidgetInterface, ContainerFactoryPluginInterface {

  use FacetsFormWidgetTrait;

  /**
   * The renderer service.
   *
   * @var \Drupal\Core\Render\RendererInterface
   */
  protected $renderer;

  /**
   * Constructs a new facet plugin instance.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param \Drupal\Core\Render\RendererInterface $renderer
   *   The renderer service.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, RendererInterface $renderer) {
    parent::__construct($configuration, $plugin_id, $plugin_definition, $renderer);
    $this->renderer = $renderer;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition): self {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('renderer')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function build(FacetInterface $facet): array {
    $items = parent::build($facet)[$facet->getFieldIdentifier()] ?? [];
    $configuration = $this->getConfiguration();

    $this->processItems($items, $facet);

    $options = $default_value = $depths = $ancestors = [];
    $options_attributes = [];
    $index = 0;

    foreach ($this->processedItems as $value => $data) {
      $options[$value] = $data['label'];

      if ($index > ((int) $configuration['soft_limit'] - 1)) {
        $options_attributes[$value] = ['class' => ['facets-soft-limit-checkbox']];
      }

      if ($data['default']) {
        $default_value[] = $value;
      }
      $depths[$value] = $data['depth'];
      $ancestors[$value] = $data['ancestors'] ?? [];
      $index++;
    };

    $build = [
      $facet->id() => [
        '#type' => 'fieldset',
        '#title' => $facet->get('show_title') ? $facet->getName() : NULL,
        '#access' => !empty($this->processedItems) && !$facet->getOnlyVisibleWhenFacetSourceIsVisible(),
        '#attributes' => [
          'data-drupal-facets-form-ancestors' => Json::encode($ancestors),
          'data-drupal-facet-id' => $facet->id(),
          'data-soft-limit' => $configuration["soft_limit"],
          'class' => [
            'facets-form-searchable-checkbox',
          ],
        ],
        'facets_widget_searchbox_label' => [
          '#markup' => Markup::create('<label id="label_' . $facet->id() . '" for="' . $facet->id() . '">' . $this->t('Search') . '</label>'),
        ],
        'facets_widget_searchbox' => [
          '#type' => 'textfield',
          '#attributes' => [
            'title' => $this->t('Search'),
            'id' => $facet->id(),
            'aria-labelledby' => 'label_' . $facet->id(),
            'class' => [
              'facets-form-searchable-checkbox-searchbox',
            ],
            'placeholder' => $this->t('Search'),
          ],
        ],
        $facet->id() => [
          '#type' => 'checkboxes',
          '#attributes' => [
            'class' => [
              'facets-form-searchable-checkbox-list-item',
            ],
          ],
          '#disabled' => $this->getConfiguration()['disabled_on_empty'] && empty($items),
          '#options' => $options,
          '#options_attributes' => $options_attributes,
          '#default_value' => $default_value,
          '#after_build' => [[static::class, 'indentCheckboxes']],
          '#depths' => $depths,
          '#ancestors' => $ancestors,
          '#indent_class' => $this->getConfiguration()['indent_class'],
        ],
        'facets_no_results' => [
          '#type' => 'markup',
          '#markup' => '<div class="no-results-message hidden">' . $this->t('No results found.') . '</div>',
        ],
        'facets_show_more' => [
          '#type' => 'markup',
          '#markup' => '<a href="#" class="show-more-link hidden">' . $this->t('Show more') . '<span class="show-more-link-count"></span></a>',
        ],
        'facets_show_less' => [
          '#type' => 'markup',
          '#markup' => '<a href="#" class="show-less-link hidden">' . $this->t('Show less') . '</a>',
        ],
      ],
    ];

    return $build;
  }

  /**
   * {@inheritdoc}
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state, FacetInterface $facet): array {
    $form = parent::buildConfigurationForm($form, $form_state, $facet);
    $configuration = $this->getConfiguration();

    $options = [50, 40, 30, 20, 15, 10, 5, 3];
    $form['soft_limit'] = [
      '#type' => 'select',
      '#title' => $this->t('Soft limit'),
      '#default_value' => $configuration['soft_limit'],
      '#options' => [0 => $this->t('No limit')] + array_combine($options, $options),
      '#description' => $this->t('Limit the number of displayed facets via JavaScript.'),
    ];
    $form['soft_limit_settings'] = [
      '#type' => 'container',
      '#title' => $this->t('Soft limit settings'),
      '#states' => [
        'invisible' => [':input[name="widget_config[soft_limit]"]' => ['value' => 0]],
      ],
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function prepareValueForUrl(FacetInterface $facet, array &$form, FormStateInterface $form_state): array {
    return array_keys(array_filter($form_state->getValue($facet->id(), [])));
  }

}
