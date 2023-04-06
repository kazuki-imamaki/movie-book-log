import Authenticated from "../Layouts/Authenticated";
import { Head } from "@inertiajs/react";
import { router } from "@inertiajs/react";

const ImageResults = (props: any) => {
    const getImage = (e: any) => {
        props.setPostData({
            ...props.postData,
            title: props.results[e.target.id].title,
            poster_path: props.results[e.target.id].poster_path,
        });
        props.setSearchFlag(false);
    };

    return (
        <>
            {props.searchFlag && (
                <div className="fixed top-0 left-0 right-0 w-hull h-full flex justify-center items-center flex-col">
                    <div className="overflow-scroll w-screen bg-gray-900 border border-gray-200 shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
                        {props.results.map((result: any, index: any) => (
                            <div className="m-2 flex" key={index}>
                                <button>
                                    <img
                                        onClick={(e) => {
                                            getImage(e);
                                        }}
                                        id={index}
                                        src={result.poster_path}
                                        alt=""
                                    />
                                </button>
                                <h2 className="text-white">{result.title}</h2>
                            </div>
                        ))}
                    </div>
                </div>
            )}
        </>
    );
};
export default ImageResults;
