import { type PropType, type RendererElement, type SlotsType } from 'vue';
declare const _default: import("vue").DefineComponent<{
    tag: {
        type: StringConstructor;
        default: string;
    };
    to: {
        type: PropType<string | RendererElement | null | undefined>;
        default: null;
    };
    skip: {
        type: BooleanConstructor;
        default: boolean;
    };
}, () => import("vue").VNode<import("vue").RendererNode, RendererElement, {
    [key: string]: any;
}> | import("vue").VNode<import("vue").RendererNode, RendererElement, {
    [key: string]: any;
}>[] | undefined, unknown, {}, {}, import("vue").ComponentOptionsMixin, import("vue").ComponentOptionsMixin, {}, string, import("vue").VNodeProps & import("vue").AllowedComponentProps & import("vue").ComponentCustomProps, Readonly<import("vue").ExtractPropTypes<{
    tag: {
        type: StringConstructor;
        default: string;
    };
    to: {
        type: PropType<string | RendererElement | null | undefined>;
        default: null;
    };
    skip: {
        type: BooleanConstructor;
        default: boolean;
    };
}>>, {
    tag: string;
    to: string | RendererElement | null | undefined;
    skip: boolean;
}, SlotsType<{
    default?: Record<string, never> | undefined;
}>>;
export default _default;
