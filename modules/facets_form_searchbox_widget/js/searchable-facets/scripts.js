/**
 * @file
 * RDS SBD SSR Search behaviors.
 */

 (function ($, Drupal) {

  'use strict';

  /**
   * Behavior description.
   */
  Drupal.behaviors.rdsSbdSsrSearch = {
    attach: function (context, settings) {

      $(context).find(".facets-form").once("facets-form-searchable-facets").each(function () {

        const $facetsWidgetSearchbox = $('.facets-form-searchable-checkbox-searchbox', context);
        
        $facetsWidgetSearchbox.on("keyup", function () { 
          let $targetList = $(this).closest('.panel-body').find('.form-checkboxes .checkbox');
          let filter = $(this).val().toUpperCase();
          let $targetForm = $(this).closest('.facets-form-searchable-checkbox');
          let $targetId = $targetForm.attr('data-drupal-facet-id');
          let $softLimit = $targetForm.attr('data-soft-limit');
          let $noResultsEl = $(this).closest('.panel-body').find('.no-results-message');
          search($targetList, filter);

          handleNoResults($targetId, $noResultsEl);
        });

        handleSoftLimit($facetsWidgetSearchbox);
        handleShowMoreBtn($facetsWidgetSearchbox);

        // Search the available facets list.
        function search($targetList, filter) {
          if (filter !== '' && filter.length >= 2) {
            $targetList.each(function (index) {
              let value = $(this).find('.facet-item__value').html();
                if (value.toUpperCase().indexOf(filter) > -1) {
                  $(this).addClass('show-facet-item-searchable-facets');
                } else {
                  $(this).removeClass('show-facet-item-searchable-facets');
                }
            });

          }
          else {
            handleSoftLimit($facetsWidgetSearchbox);
          }
        }

        // Handles the soft limit to hide all additional elements.
        function handleSoftLimit($facetsWidgetSearchbox) {
          $facetsWidgetSearchbox.each(function (){
            let $targetForm = $(this).closest('.facets-form-searchable-checkbox');
            let $softLimit = parseInt($targetForm.attr('data-soft-limit'));
            let $targetList = $(this).closest('.panel-body').find('.form-checkboxes .checkbox');

            $targetList.each(function (index) {
              // Show all elements by default if softLimit is 'no limit'.
              if (index < $softLimit || $softLimit == 0) {
                $(this).addClass('show-facet-item-searchable-facets');
              }
              else {
                $(this).removeClass('show-facet-item-searchable-facets');
                $(this).addClass('facet-item-hidden-searchable-facets');
              }

              // Ensure the checked values are always displayed.
              var $checkbox = $(this).find('.facets-form-searchable-checkbox-list-item');
              if ($checkbox[0].checked == true) {
                $(this).show();
              }
            });

          });
        }

        // Handles the soft limit to hide all additional elements.
        function handleShowMoreBtn($facetsWidgetSearchbox) {
          $facetsWidgetSearchbox.each(function (){
            let $targetForm = $(this).closest('.facets-form-searchable-checkbox');
            let $softLimit = parseInt($targetForm.attr('data-soft-limit'));
            let $targetList = $(this).closest('.panel-body').find('.form-checkboxes .checkbox');
            let $showMoreFacetCountEl = $(this).closest('.panel-body').find('.show-more-link-count');
            let hasHiddenFacets = false;
            let hiddenItemsCount = 0;
            let $showMoreLink = $(this).closest('.panel-body').find('.show-more-link');
            let $showLessLink = $(this).closest('.panel-body').find('.show-less-link');

            $targetList.each(function (index) {
              if (hasHiddenFacets == false && $(this).hasClass('facet-item-hidden-searchable-facets')) {
                hasHiddenFacets = true;
                $showMoreLink.removeClass('hidden');
              }

              if (hasHiddenFacets && $(this).hasClass('facet-item-hidden-searchable-facets')) {
                hiddenItemsCount++;
                $(this).addClass('hidden-facet-elements');
              }
            });

            $showMoreFacetCountEl.text(' (' + hiddenItemsCount + ')');


            $showMoreLink.on('click', function(e) {
              e.preventDefault();
              $showLessLink.removeClass('hidden');
              $(this).addClass('hidden');
              let $list = $(this).closest('.panel-body').find('.hidden-facet-elements');
              $list.each(function(){
                $(this).addClass('show-facet-item-searchable-facets soft-limit-item-hidden');
              });
            });

            $showLessLink.on('click', function(e) {
              e.preventDefault();
              $showMoreLink.removeClass('hidden');
              $(this).addClass('hidden');
              let $list = $(this).closest('.panel-body').find('.soft-limit-item-hidden');
              $list.each(function(){
                $(this).removeClass('show-facet-item-searchable-facets soft-limit-item-hidden');
              });
            });

          });
        }

        // Toggles the no results message.
        function handleNoResults($targetId, $noResultsEl) {
          let $results = $('[data-drupal-facet-id="' + $targetId + '"] .form-checkboxes .checkbox:visible');
          if ($results.length === 0) {
            $noResultsEl.removeClass('hidden');
          }
          else {
            $noResultsEl.addClass('hidden');
          }
        }
      });

    }
  };

} (jQuery, Drupal));
