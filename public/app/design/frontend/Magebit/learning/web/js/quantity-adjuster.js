define(["ko", "uiComponent"], function (ko, Component) {
    "use strict";

    return Component.extend({
        defaults: {
            qty: ko.observable(1),
            stockQty: 0,
            isInStock: true,
            stockStatus: ko.observable(""),
            canAddToCart: ko.observable(true),
        },

        initialize: function () {
            this._super();
            this.updateStockStatus();

            if (this.stockQty <= 0) {
                this.canAddToCart(false);
            }

            this.qty.subscribe(function (newQty) {
                this.updateAddToCartButton(newQty);
            }, this);
        },

        /** Decrease quantity */
        decreaseQty: function () {
            if (this.qty() > 1) {
                this.qty(this.qty() - 1);
            }
        },

        /** Increase quantity */
        increaseQty: function () {
            if (this.qty() < this.stockQty) {
                this.qty(this.qty() + 1);
            }
        },

        /** Update stock status message */
        updateStockStatus: function () {
            if (this.isInStock) {
                this.stockStatus(
                    "<strong>IN STOCK</strong> " +
                        this.stockQty +
                        " items available"
                );
            } else {
                this.stockStatus("Out of Stock");
            }
        },

        /** Enable/disable Add to Cart button based on quantity */
        updateAddToCartButton: function (qty) {
            if (qty > this.stockQty || qty < 1) {
                this.canAddToCart(false);
            } else {
                this.canAddToCart(true);
            }
        },
    });
});
