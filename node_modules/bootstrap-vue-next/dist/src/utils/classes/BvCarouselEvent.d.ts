import BvEvent, { type BvEventConstructorOmittables } from './BvEvent';
export default class BvCarouselEvent extends BvEvent {
    readonly from: number;
    readonly to: number;
    readonly direction: 'left' | 'right';
    constructor(eventType: string, eventInit: Partial<Omit<BvEvent, BvEventConstructorOmittables>> & {
        from: number;
        to: number;
        direction: 'left' | 'right';
    });
    static get Defaults(): {
        cancelable: boolean;
        componentId: null;
        eventType: string;
        nativeEvent: null;
        relatedTarget: null;
        target: null;
    };
}
