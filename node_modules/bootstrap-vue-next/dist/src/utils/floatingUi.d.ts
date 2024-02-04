import type { Placement } from '@floating-ui/vue';
export { autoUpdate } from '@floating-ui/vue';
import { type App, type DirectiveBinding, type Ref } from 'vue';
/**
 * Configures Bootstrap-like placement props to floating-ui Placement strings.
 * Top drops up, bottom drops down, end drops right, start drops left, dropend will _align_ the drop to the 'end',
 * dropstart will _align_ the drop to the 'start'. Bottom is default, so it is the last in the order. Bottom should essentially be the opposite of top
 * @param {top: boolean; bottom: boolean; start: boolean; end: boolean; dropstart: boolean; dropend: boolean}
 * @returns {Placement} Placement
 */
export declare const resolveFloatingPlacement: ({ top, end, start, alignCenter, alignEnd, }: {
    top: boolean;
    start: boolean;
    end: boolean;
    alignCenter: boolean;
    alignEnd: boolean;
}) => Placement;
export declare const resolveBootstrapPlacement: (placement: Placement) => string;
export declare const resolveActiveStatus: (values: DirectiveBinding['value']) => boolean;
export declare const resolveContent: (values: DirectiveBinding['value'], el: HTMLElement) => {
    title?: string | undefined;
    content?: string | undefined;
};
export declare const resolveDirectiveProps: (binding: DirectiveBinding, el: HTMLElement) => any;
export interface ElementWithPopper extends HTMLElement {
    $__state?: Ref<{
        title: string;
        target: HTMLElement;
    }>;
    $__app?: App;
    $__element?: HTMLElement;
}
export declare const bind: (el: ElementWithPopper, binding: DirectiveBinding) => void;
export declare const unbind: (el: ElementWithPopper) => void;
