/**
 * @file
 * Core views facets AJAX handling.
 */

/**
 * @name CoreViewFacetsSettings
 * @property {String} view_id
 * @property {String} current_display_id
 * @property {String} view_base_path
 * @property {String} field_id
 */

/**
 * @property {CoreViewFacetsSettings[]} drupalSettings.core_views_facets
 * @property {string} drupalSettings.views.ajax_path
 */


(function ($, Drupal, once) {
  'use strict';

  /**
   * Trigger views AJAX refresh on click.
   */
  Drupal.behaviors.coreViewsFacetsViewsAjax = {
    attach: function (context, settings) {

      $.each(settings.core_views_facets, function (facetId, facetSettings) {
        $(
          once(
            'core_views_facet-id' + facetId,
            'ul[data-drupal-facet-id=' + facetId + ']  li a',
          ),
        ).click(function (e) {
          e.preventDefault();
          var facetLink = $(this);
          var view = $('.view-id-' + facetSettings.view_id + '.view-display-id-' + facetSettings.current_display_id).first();

          var start = view.attr('class').indexOf('js-view-dom-id-');
          var end = view.attr('class').indexOf(' ', start);
          var current_dom_id = view.attr('class').substr(start + 15, (view.attr('class').length - start - 15 - end));

          if (typeof Drupal.views.instances['views_dom_id:' + current_dom_id] === 'undefined') {
            return;
          }

          var views_parameters = Drupal.Views.parseQueryString(facetLink.attr('href'));
          var views_arguments = Drupal.Views.parseViewArgs(facetLink.attr('href'), facetSettings.view_base_path);

          var core_views_settings = $.extend(
            {},
            Drupal.views.instances['views_dom_id:' + current_dom_id].settings,
            views_arguments,
            views_parameters
          );

          var core_views_ajax_settings = Drupal.views.instances['views_dom_id:' + current_dom_id].element_settings;
          core_views_ajax_settings.submit = core_views_settings;

          // Ensure removing any get parameters which would override "our" parameters.
          core_views_ajax_settings.url = settings.views.ajax_path;

          Drupal.ajax(core_views_ajax_settings).execute();
        });
      });
    }
  };

})(jQuery, Drupal, once);
