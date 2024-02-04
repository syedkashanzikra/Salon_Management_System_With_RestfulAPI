export interface ComponentProps {
    [key: string]: {
        type: any[];
        default: any;
    };
}
declare const _default: (props: Record<PropertyKey, unknown>, els: ComponentProps, propPrefix: string, classPrefix?: string) => string[];
export default _default;
