import { type PropType, type SlotsType } from 'vue';
import type { AlignmentContent, AlignmentJustifyContent, AlignmentVertical, Booleanish } from '../types';
declare const _default: import("vue").DefineComponent<{
    tag: {
        type: StringConstructor;
        default: string;
    };
    gutterX: {
        type: StringConstructor;
        default: null;
    };
    gutterY: {
        type: StringConstructor;
        default: null;
    };
    noGutters: {
        type: PropType<Booleanish>;
        default: boolean;
    };
    alignV: {
        type: PropType<AlignmentVertical>;
        default: null;
    };
    alignH: {
        type: PropType<AlignmentJustifyContent>;
        default: null;
    };
    alignContent: {
        type: PropType<AlignmentContent>;
        default: null;
    };
}, {
    computedClasses: import("vue").ComputedRef<(string[] | {
        [x: string]: boolean;
        'g-0': boolean;
    })[]>;
}, unknown, {}, {}, import("vue").ComponentOptionsMixin, import("vue").ComponentOptionsMixin, {}, string, import("vue").VNodeProps & import("vue").AllowedComponentProps & import("vue").ComponentCustomProps, Readonly<import("vue").ExtractPropTypes<{
    tag: {
        type: StringConstructor;
        default: string;
    };
    gutterX: {
        type: StringConstructor;
        default: null;
    };
    gutterY: {
        type: StringConstructor;
        default: null;
    };
    noGutters: {
        type: PropType<Booleanish>;
        default: boolean;
    };
    alignV: {
        type: PropType<AlignmentVertical>;
        default: null;
    };
    alignH: {
        type: PropType<AlignmentJustifyContent>;
        default: null;
    };
    alignContent: {
        type: PropType<AlignmentContent>;
        default: null;
    };
}>>, {
    gutterX: string;
    gutterY: string;
    tag: string;
    noGutters: Booleanish;
    alignV: AlignmentVertical;
    alignH: AlignmentJustifyContent;
    alignContent: AlignmentContent;
}, SlotsType<{
    default?: Record<string, never> | undefined;
}>>;
export default _default;
