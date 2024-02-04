declare const _default: () => {
    items: (string | {
        active?: boolean | undefined;
        disabled?: boolean | undefined;
        href?: string | undefined;
        text: string;
        to?: string | {
            query?: import("vue-router").LocationQueryRaw | undefined;
            hash?: string | undefined;
            path: string;
            replace?: boolean | undefined;
            force?: boolean | undefined;
            state?: import("vue-router").HistoryState | undefined;
        } | {
            query?: import("vue-router").LocationQueryRaw | undefined;
            hash?: string | undefined;
            name?: import("vue-router").RouteRecordName | undefined;
            params?: import("vue-router").RouteParamsRaw | undefined;
            replace?: boolean | undefined;
            force?: boolean | undefined;
            state?: import("vue-router").HistoryState | undefined;
        } | undefined;
    })[];
    reset: () => void;
};
export default _default;
