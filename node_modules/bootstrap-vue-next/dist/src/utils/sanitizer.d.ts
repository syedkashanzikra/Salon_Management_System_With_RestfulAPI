/**
 * --------------------------------------------------------------------------
 * Bootstrap (v5.2.3): util/sanitizer.js
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
 * --------------------------------------------------------------------------
 */
export declare const DefaultAllowlist: {
    '*': (string | RegExp)[];
    a: string[];
    area: never[];
    b: never[];
    br: never[];
    col: never[];
    code: never[];
    div: never[];
    em: never[];
    hr: never[];
    h1: never[];
    h2: never[];
    h3: never[];
    h4: never[];
    h5: never[];
    h6: never[];
    i: never[];
    img: string[];
    li: never[];
    ol: never[];
    p: never[];
    pre: never[];
    s: never[];
    small: never[];
    span: never[];
    sub: never[];
    sup: never[];
    strong: never[];
    u: never[];
    ul: never[];
};
export declare const sanitizeHtml: (unsafeHtml: string, allowList: Record<string, (string | RegExp)[]>, sanitizeFunction?: ((unsafeHtml: string) => string) | undefined) => string;
