import { type UseColorModeOptions } from '@vueuse/core';
export interface ColorModeOptions extends UseColorModeOptions {
    /**
     * When set to true, useColorMode will automatically store itself and persist (default localstorage).
     * @default false
     */
    persist?: boolean;
}
declare const _default: (opts?: ColorModeOptions) => import("@vueuse/core").UseColorModeReturn<import("@vueuse/core").BasicColorMode>;
export default _default;
