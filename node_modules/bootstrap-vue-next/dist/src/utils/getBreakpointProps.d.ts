type PropDefinition = {
    type: any[];
    default: any;
};
export interface ComponentProps {
    [key: string]: PropDefinition;
}
declare const _default: (prefix: string, breakpoints: string[], definition: PropDefinition) => ComponentProps;
export default _default;
