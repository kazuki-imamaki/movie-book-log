import axios from "axios";
const Switch = (props) => {
    const getWant = async () => {
        await axios.get("/api/want").then((res) => {
            props.setContents(res.data);
        });
        props.setDoneFlag(false);
    };

    const getDone = async () => {
        await axios.get("/api/done").then((res) => {
            props.setContents(res.data);
        });
        props.setDoneFlag(true);
    };
    return (
        <>
            {/* <div className="container flex justify-center flex-wrap items-center mx-auto">
                <div
                    className="items-center justify-between hidden w-full md:flex md:w-auto md:order-1"
                    id="navbar-sticky"
                >
                    <div>
                        <button onClick={getWant}>Want to</button>
                    </div>
                    <div>
                        <button onClick={getDone}>Done</button>
                    </div>
                </div>
            </div> */}

            <div className="border-b border-gray-500 dark:border-gray-700 flex justify-center bg-gray-900">
                <ul className="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500 dark:text-gray-400">
                    <li className="mr-2">
                        <button
                            className={
                                props.doneFlag
                                    ? "inline-flex p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 group"
                                    : "inline-flex p-4 text-indigo-600 border-b-2 border-blue-600 rounded-t-lg active dark:text-blue-500 dark:border-blue-500 group"
                            }
                            onClick={getWant}
                        >
                            Want to
                        </button>
                    </li>
                    <li className="mr-2">
                        <button
                            className={
                                props.doneFlag
                                    ? "inline-flex p-4 text-blue-600 border-b-2 border-blue-600 rounded-t-lg active dark:text-blue-500 dark:border-blue-500 group"
                                    : "inline-flex p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 group"
                            }
                            onClick={getDone}
                        >
                            Done
                        </button>
                    </li>
                </ul>
            </div>
        </>
    );
};
export default Switch;
