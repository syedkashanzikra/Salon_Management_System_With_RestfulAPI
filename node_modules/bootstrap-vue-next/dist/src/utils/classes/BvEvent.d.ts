/**
 * Items that are omitted from the BvEventInit constructor arg
 */
export type BvEventConstructorOmittables = 'eventType' | 'defaultPrevented';
export default class BvEvent {
    readonly cancelable: boolean;
    readonly componentId: string | null;
    private _defaultPrevented;
    readonly eventType: string;
    readonly nativeEvent: string | null;
    private _preventDefault;
    readonly relatedTarget: EventTarget | null;
    readonly target: EventTarget | null;
    get defaultPrevented(): boolean;
    protected set defaultPrevented(prop: boolean);
    get preventDefault(): () => void;
    protected set preventDefault(setter: () => void);
    constructor(eventType: string, eventInit?: Partial<Omit<BvEvent, BvEventConstructorOmittables>>);
    static get Defaults(): {
        cancelable: boolean;
        componentId: null;
        eventType: string;
        nativeEvent: null;
        relatedTarget: null;
        target: null;
    };
}
