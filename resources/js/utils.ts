import useStore from "@src/store/store";

export const shorten = (message: string, maxLength: number = 23) => {
    const text = message;

    if (text) {
        let trimmedString = text;
        if (text.length > maxLength) {

            trimmedString = trimmedString.slice(0, maxLength);
            trimmedString += "...";
        }
        return trimmedString;
    }

    return "";
};



