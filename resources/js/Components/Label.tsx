import React from "react";

interface Props {
    forInput: string;
    value: string;
    className?: string;
    children?: React.ReactNode;
}

export default function Label({ forInput, value, className, children }: Props) {
    return (
        <label
            htmlFor={forInput}
            className={`block font-medium text-sm text-white ` + className}
        >
            {value ? value : children}
        </label>
    );
}
