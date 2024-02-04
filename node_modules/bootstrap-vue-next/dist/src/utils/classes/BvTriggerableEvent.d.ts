import BvEvent, { type BvEventConstructorOmittables } from './BvEvent';
export default class BvTriggerableEvent extends BvEvent {
    readonly trigger: string | null;
    constructor(eventType: string, eventInit?: Partial<Omit<BvTriggerableEvent, BvEventConstructorOmittables>>);
    static get Defaults(): {
        trigger: null;
        cancelable: boolean;
        componentId: null;
        eventType: string;
        nativeEvent: null;
        relatedTarget: null;
        target: null;
    };
}
