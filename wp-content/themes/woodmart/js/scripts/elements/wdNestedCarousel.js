jQuery( window ).on('elementor/nested-element-type-loaded', async () => {
    class NestedCarousel extends elementor.modules.elements.types.NestedElementBase {
        getType() {
            return 'wd_nested_carousel';
        }
    }

    class Module {
        constructor() {
            elementor.elementsManager.registerElementType( new NestedCarousel() );
        }
    }

    new Module();
});
